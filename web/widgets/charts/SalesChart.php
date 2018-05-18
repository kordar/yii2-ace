<?php
namespace kordar\ace\web\widgets\charts;

use kordar\ace\web\assets\plugins\chart\FlotAsset;
use yii\base\Widget;
use yii\helpers\Html;

class SalesChart extends Widget
{
    public $id = 'sales-charts';

    public $salesCharts = [
        'width'=>'100%', 'height'=>'220px'
    ];

    public $data = [
        ["label"=>"Domains", "data"=> [
                [0, 0], [0.5, 0.479425538604203], [1, 0.8414709848078965], [1.5, 0.9974949866040544],
                [2, 0.9092974268256817], [2.5, 0.5984721441039564], [3, 0.1411200080598672],
                [3.5, -0.35078322768961984], [4, -0.7568024953079282], [4.5, -0.977530117665097],
                [5, -0.9589242746631385], [5.5, -0.7055403255703919], [6, -0.27941549819892586]
            ]
        ],
    ];

    protected function salesChartsOption()
    {
        return json_encode($this->salesCharts);
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
        
            var sales_charts = $('#{$this->id}').css({$this->salesChartsOption()});
            var data = {$this->getData()};
            $.plot("#sales-charts", data, {
                hoverable: true,
                shadowSize: 0,
                series: {
                    lines: { show: true },
                    points: { show: true }
                },
                xaxis: {
                    tickLength: 0
                },
                yaxis: {
                    ticks: 10,
                    min: -2,
                    max: 2,
                    tickDecimals: 3
                },
                grid: {
                    backgroundColor: { colors: [ "#fff", "#fff" ] },
                    borderWidth: 1,
                    borderColor:'#555'
                }
            });
JS;
        $this->view->registerJs($js);
    }

}