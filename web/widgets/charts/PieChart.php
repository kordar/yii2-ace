<?php
namespace kordar\ace\web\widgets\charts;

use kordar\ace\web\assets\plugins\chart\EasyPieChartAsset;
use kordar\ace\web\assets\plugins\chart\FlotAsset;
use yii\base\Widget;
use yii\helpers\Html;

class PieChart extends Widget
{
    public $id = 'piechart-placeholder';

    public $placeholder = [
        'width'=>'90%' , 'min-height'=>'150px'
    ];

    public $data = [
        ["label"=>"social networks",  "data"=>4.2, "color"=>"#68BC31"],
    ];

    protected function placeHolderOption()
    {
        return json_encode($this->placeholder);
    }

    protected function getData()
    {
        return json_encode($this->data);
    }

    public function run()
    {
        echo Html::tag('div', '', ['id'=>$this->id]);
        $this->registerClientScript();
    }

    protected function registerClientScript()
    {
        FlotAsset::register($this->view);

        $js = <<<JS
        
            var placeholder = $('#{$this->id}').css({$this->placeHolderOption()});
            var data = {$this->getData()};
			  
              function drawPieChart(placeholder, data, position) {
                  \$.plot(placeholder, data, {
                    series: {
                        pie: {
                            show: true,
                            tilt:0.8,
                            highlight: {
                                opacity: 0.25
                            },
                            stroke: {
                                color: '#fff',
                                width: 2
                            },
                            startAngle: 2
                        }
                    },
                    legend: {
                        show: true,
                        position: position || "ne", 
                        labelBoxBorderColor: null,
                        margin:[-30,15]
                    }
                    ,
                    grid: {
                        hoverable: true,
                        clickable: true
                    }
                 })
             }
			 drawPieChart(placeholder, data);
			
			 /**
			 we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
			 so that's not needed actually.
			 */
			 placeholder.data('chart', data);
			 placeholder.data('draw', drawPieChart);
			
			
			  //pie chart tooltip example
			  var tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
			  var previousPoint = null;
			
			  placeholder.on('plothover', function (event, pos, item) {
				if(item) {
					if (previousPoint !== item.seriesIndex) {
						previousPoint = item.seriesIndex;
						var tip = item.series['label'] + " : " + item.series['percent']+'%';
						tooltip.show().children(0).text(tip);
					}
					tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
				} else {
					tooltip.hide();
					previousPoint = null;
				}
				
			 });
JS;
        $this->view->registerJs($js);
    }

}