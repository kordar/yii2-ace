<?php
namespace kordar\ace\web\widgets\boxes;

use kordar\ace\web\assets\plugins\chart\EasyPieChartAsset;
use kordar\ace\web\assets\plugins\chart\SparkLineAsset;
use yii\base\Widget;
use yii\helpers\Html;

class InfoBox extends Widget
{
    public $template = '{infoBoxIcon}{infoBoxData}{badge}';

    /**
     * @var string
     */
    public $theme = 'infobox-blue';
    public $icon = 'fa-twitter';

    /**
     * @var string
     */
    public $dataContent = 'Info box data';
    public $dataNumber = 100;
    public $dataText = 'Info box text';
    public $data3 = ['Info A', 'Info B'];

    /**
     * @var string
     */
    public $badgeTheme = 'badge-success';
    public $badgeIcon = 'fa-arrow-up';
    public $badgeContent = '+100%';

    /**
     * @var string
     */
    public $statTheme = 'stat-important';
    public $statContent = '40%';

    /**
     * @var string
     */
    public $chartValues = '1,2,3';

    /**
     * @var string
     */
    public $progressPercent = '42';
    public $progressSize = '46';
    public $progressText = '<span class="percent">42</span>%';

    public function run()
    {
        preg_match_all('/\{[a-zA-Z0-9]*\}/', $this->template, $match);

        $template = [];
        if (isset($match[0])) {
            foreach ($match[0] as $render) {
                $key = trim($render, '\{\}');
                $template[$render] = $this->{'render' . ucfirst($key)}();
            }
        }

        return '<div class="infobox ' . $this->theme . '">' . strtr($this->template, $template) . '</div>';
    }

    public function renderTheme()
    {
        return $this->theme;
    }

    /**
     * @return string
     * Stat Element
     */
    protected function renderStat()
    {
        return Html::tag('div', $this->statContent, ['class'=>'stat ' . $this->statTheme]);
    }

    protected function renderInfoBoxIcon()
    {
        return Html::tag('div', Html::tag('i', '', ['class'=>'ace-icon fa ' . $this->icon]), ['class'=>'infobox-icon']);
    }

    /**
     * @return string
     * Data Element
     */
    protected function renderInfoBoxData()
    {
        return Html::tag('div',
            Html::tag('span', $this->dataNumber, ['class'=>'infobox-data-number']) .
            Html::tag('div', $this->dataContent, ['class'=>'infobox-content']), ['class'=>'infobox-data']);
    }

    protected function renderInfoBoxData2()
    {
        return Html::tag('div',
            Html::tag('span', $this->dataText, ['class'=>'infobox-text']) .
            Html::tag('div', $this->dataContent, ['class'=>'infobox-content']), ['class'=>'infobox-data']);
    }

    protected function renderInfoBoxData3()
    {
        return Html::tag('div', '<div class="infobox-content">' . $this->data3[0] . '</div><div class="infobox-content">' . $this->data3[1] . '</div>', ['class'=>'infobox-data']);
    }

    /**
     * @return string
     */
    protected function renderBadge()
    {
        return Html::tag('div', $this->badgeContent . Html::tag('i', '', ['class'=>'ace-icon fa ' . $this->badgeIcon]), ['class'=>'badge ' . $this->badgeTheme]);
    }

    /**
     * @return string
     */
    protected function renderInfoBoxChart()
    {
        SparkLineAsset::register($this->view);
        $this->view->registerJs('$(\'.sparkline\').each(function(){
					var $box = $(this).closest(\'.infobox\');
					var barColor = !$box.hasClass(\'infobox-dark\') ? $box.css(\'color\') : \'#FFF\';
					$(this).sparkline(\'html\',
									 {
										tagValuesAttribute:\'data-values\',
										type: \'bar\',
										barColor: barColor ,
										chartRangeMin:$(this).data(\'min\') || 0
									 });
				});');
        return Html::tag('div', Html::tag('span', '', ['class'=>'sparkline', 'data-values'=>$this->chartValues]), ['class'=>'infobox-chart']);
    }

    /**
     * @return string
     */
    protected function renderInfoBoxProgress()
    {
        EasyPieChartAsset::register($this->view);
        $this->view->registerJs('$(\'.easy-pie-chart.percentage\').each(function(){
					var $box = $(this).closest(\'.infobox\');
					var barColor = $(this).data(\'color\') || (!$box.hasClass(\'infobox-dark\') ? $box.css(\'color\') : \'rgba(255,255,255,0.95)\');
					var trackColor = barColor == \'rgba(255,255,255,0.95)\' ? \'rgba(255,255,255,0.25)\' : \'#E2E2E2\';
					var size = parseInt($(this).data(\'size\')) || 50;
					$(this).easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: \'butt\',
						lineWidth: parseInt(size/10),
						animate: ace.vars[\'old_ie\'] ? false : 1000,
						size: size
					});
				})');
        return strtr('<div class="infobox-progress"><div class="easy-pie-chart percentage" data-percent="{percent}" data-size="{size}">{text}</div></div>', [
            '{percent}' => $this->progressPercent, '{size}' => $this->progressSize, '{text}' => $this->progressText
        ]);
    }


}