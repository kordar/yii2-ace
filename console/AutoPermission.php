<?php
namespace kordar\ace\console;

use Yii;

class AutoPermission
{

    public function autoRun($filename = '', $module = '')
    {
        $actions = [];
        $items = [];

        // Simple way to get all files in a directory
        $files = new \FilesystemIterator($filename);

        foreach($files as $file)
        {
            $controller = $file->getFilename();
            $match = [];
            preg_match("/([a-zA-Z]+)Controller\.php/", $controller, $match);
            $class = lcfirst($match[1]);

            if ($class == 'ace') {
                continue;
            }

            $namespace = empty($module) ? $class : $module . '/' . $class;

            array_push($actions, $namespace . '/*');

            $document = new \SplFileObject($file->getPathname());

            foreach($document as $line) {

                if (preg_match('/@item (.+)/', $line, $_item)) {
                    $itemArr = explode(':', $_item[1]);
                    $key = $namespace . '/' . trim($itemArr[0]);
                    $items[$key] = trim($itemArr[1]);
                }

                if (preg_match('/public function action([a-zA-Z0-9_]+)/', $line, $_action)) {
                    if (preg_match('/[A-Z]/', $_action[1])) {
                        $str = lcfirst($_action[1]);
                        $actions[] = $namespace . '/' . preg_replace_callback('/[A-Z]/', function($matches){
                                return '-' . strtolower($matches[0]);
                            }, $str);
                    }
                }

            }
        }

        $auth = Yii::$app->authManager;

        //$auth->removeAllPermissions();

        foreach ($actions as $action) {
            $obj = $auth->createPermission($action);
            $obj->description = isset($items[$action]) ? $items[$action] : $action;
            if (!$auth->getPermission($action)) {
                $auth->add($obj);
            } else {
                $auth->update($action, $obj);
            }
        }

    }

    /*public function actionAuto()
    {

        $path = dirname(dirname(__DIR__));
        $filesMap = [
            ['module'=> '', 'filename' => $path . '/backend/controllers/'],
            ['module'=> 'basis/', 'filename' => $path . '/backend/modules/basis/controllers/'],
            ['module'=> 'rbac/', 'filename' => $path . '/backend/modules/rbac/controllers/'],
        ];

        $actions = [];
        $items = [];

        foreach ($filesMap as $fileItem) {

            $module = $fileItem['module'];
            $filename = $fileItem['filename'];
            // Simple way to get all files in a directory
            $files = new \FilesystemIterator($filename);

            foreach($files as $file)
            {
                $controller = $file->getFilename();
                $match = [];
                preg_match("/([a-zA-Z]+)Controller\.php/", $controller, $match);
                $class = lcfirst($match[1]);

                $namespace = $module . $class;

                array_push($actions, $namespace . '/*');

                $document = new \SplFileObject($file->getPathname());

                foreach($document as $line) {

                    if (preg_match('/@item (.+)/', $line, $_item)) {
                        $itemArr = explode(':', $_item[1]);
                        $key = $namespace . '/' . trim($itemArr[0]);
                        $items[$key] = trim($itemArr[1]);
                    }

                    if (preg_match('/public function action([a-zA-Z0-9_]+)/', $line, $_action)) {
                        if (preg_match('/[A-Z]/', $_action[1])) {
                            $str = lcfirst($_action[1]);
                            $actions[] = $namespace . '/' . preg_replace_callback('/[A-Z]/', function($matches){
                                    return '-' . strtolower($matches[0]);
                                }, $str);
                        }
                    }

                }
            }
        }

        $auth = Yii::$app->authManager;

        //$auth->removeAllPermissions();

        foreach ($actions as $action) {
            $obj = $auth->createPermission($action);
            $obj->description = isset($items[$action]) ? $items[$action] : $action;
            if (!$auth->getPermission($action)) {
                $auth->add($obj);
            } else {
                $auth->update($action, $obj);
            }
        }

    }*/

}