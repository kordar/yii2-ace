<?php
namespace kordar\ace\web\widgets\search;

use yii\base\Widget;
use yii\helpers\Html;

class DropDownSearch extends Widget
{
    /**
     * @var string
     */
    public $selectName = 'dropDownSearch';

    /**
     * @var string
     */
    public $inputName = 'dropDownSearchInput';

    /**
     * @var \yii\base\Model
     */
    public $model;

    /**
     * @var array
     */
    public $items = [];

    /**
     * @var array
     */
    public $inputOption = ['size' => 35];

    /**
     * @var string
     */
    public $selectExtName = 'dropDownSearchExt';

    /**
     * @var string
     */
    public $selectExt = 'compare';

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
        $params = $request->get($this->baseName);

        $selectName = $this->baseName . '[' . $this->selectName . ']';
        $option = empty($params[$this->selectName]) ? '' : $params[$this->selectName];

        $selection = Html::dropDownList($selectName, $option, $list, ['class'=>'form-control']);

        $this->inputOption['class'] = 'form-control';

        $inputName = $this->baseName . '[' . $this->inputName . ']';
        $value = empty($params[$this->inputName]) ? '' : $params[$this->inputName];

        $input = Html::input('text', $inputName, $value, $this->inputOption);

        $ext = '';
        if (!empty($this->selectExt)) {

            switch ($this->selectExt) {
                default:
                    $_list = ['EQ'=>'精确', 'LIKE'=>'模糊'];
            }

            $ext = Html::dropDownList($this->baseName . '[' . $this->selectExtName . ']', empty($params[$this->selectExtName]) ? '' : $params[$this->selectExtName], $_list, ['class'=>'form-control']);
        }

        echo Html::tag('div', "{$selection}\n{$input}\n{$ext}",  ['class'=>'form-group']);
    }
}