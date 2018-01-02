<?php
use yii\helpers\Html;
?>

<li class="light-blue dropdown-modal">
    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
        <img class="nav-user-photo" src="<?= $baseUrl . '/images/avatars/avatar.png'?>" alt="Jason's Photo" />
        <span class="user-info">
            <small>Welcome,</small>
            Json
        </span>

        <i class="ace-icon fa fa-caret-down"></i>
    </a>

    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
        <li>
            <a href="#">
                <i class="ace-icon fa fa-cog"></i>
                Settings
            </a>
        </li>

        <li>
            <a href="profile.html">
                <i class="ace-icon fa fa-user"></i>
                Profile
            </a>
        </li>

        <li class="divider"></li>

        <li>
            <?= Html::a("<i class=\"ace-icon fa fa-power-off\"></i> 注销", ['/ace/auth/logout'],
                [
                    'data' => [
                        'confirm' => '确定注销？',
                        'method' => 'post',
                    ],
                ])
            ?>
        </li>
    </ul>
</li>