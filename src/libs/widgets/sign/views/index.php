<div class="login-container">
    <div class="center">
        <h1>
            <i class="ace-icon fa fa-leaf green"></i>
            <span class="red">Ace</span>
            <span class="white" id="id-text2">应用管理</span>
        </h1>
        <h4 class="blue" id="id-company-text">&copy; 公司名称</h4>
    </div>

    <div class="space-6"></div>

    <div class="position-relative">
        
		<?= $this->render($view, [
            'model' => $model,
            'prefix' => "<span class=\"block input-icon input-icon-right\">{input}\n<i class=\"ace-icon fa ",
            'suffix' => "\"></i></span>\n{hint}\n{error}"
        ]);?>

    </div><!-- /.position-relative -->

    <div class="navbar-fixed-top align-right">
        <br />
        &nbsp;
        <a id="btn-login-dark" href="#">Dark</a>
        &nbsp;
        <span class="blue">/</span>
        &nbsp;
        <a id="btn-login-blur" href="#">Blur</a>
        &nbsp;
        <span class="blue">/</span>
        &nbsp;
        <a id="btn-login-light" href="#">Light</a>
        &nbsp; &nbsp; &nbsp;
    </div>
</div>