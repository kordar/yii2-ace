<?php
namespace kordar\ace\web\widgets\search;

use kordar\ace\web\assets\plugins\form\WDatePicketAsset;
use yii\helpers\Html;

class DropDownDateSearch extends \yii\base\Widget
{
    /**
     * @var string
     */
    public $selectName = 'dropDownSearchBetweenData';

    /**
     * @var string
     */
    public $selectStartName = 'dropDownSearchBetweenDataStart';

    /**
     * @var string
     */
    public $selectEndName = 'dropDownSearchBetweenDataEnd';

    /**
     * @var string
     */
    public $dateFormat = 'yyyy-MM-dd';

    /**
     * @var \yii\base\Model
     */
    public $model;

    /**
     * @var array
     */
    public $items = [];

    /**
     * @var string
     */
    protected $baseName = '';

    public function beforeRun()
    {
        $class = get_class($this->model);
        $this->baseName = basename(str_replace('\\', '/', $class));

        return parent::beforeRun();
    }

    public function run()
    {
        $list = [];

        foreach ($this->items as $key => $item) {
            $list[$item] = $this->model->getAttributeLabel($item);
        }

        $request = \Yii::$app->request;
        $input = $request->get($this->baseName);

        $selectName = $this->baseName . '[' . $this->selectName . ']';
        $option = empty($input[$this->selectName]) ? '' : $input[$this->selectName];

        $selection = Html::dropDownList($selectName, $option, $list, ['class'=>'form-control']);

        $div = Html::tag('div',
            Html::input('text', $this->baseName . '[' . $this->selectStartName . ']', empty($input[$this->selectStartName])?'':$input[$this->selectStartName], ['class'=>'form-control', 'onClick' => 'WdatePicker({dateFmt:\'' . $this->dateFormat . '\'})']) .
            '<span class="input-group-addon"><i class="fa fa-exchange"></i></span>' .
            Html::input('text', $this->baseName . '[' . $this->selectEndName . ']', empty($input[$this->selectEndName])?'':$input[$this->selectEndName], ['class'=>'form-control', 'onClick' => 'WdatePicker({dateFmt:\'' . $this->dateFormat . '\'})']), ['class'=>'input-group']);

        echo Html::tag('div', "{$selection}\n{$div}", ['class'=>'form-group']);

        WDatePicketAsset::register($this->view);


//        TimePickerAsset::register($this->view);
//        DateTimePickerAsset::register($this->view);

    }
}