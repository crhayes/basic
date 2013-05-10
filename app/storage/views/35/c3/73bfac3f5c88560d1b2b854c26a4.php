<?php

/* index.php */
class __TwigTemplate_35c373bfac3f5c88560d1b2b854c26a4 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<?php \$this->extend('layouts/master') ?>

<?php \$this->section('content') ?>
\t<p>This is the child content.</p>
\t@parent
<?php \$this->stop() ?>";
    }

    public function getTemplateName()
    {
        return "index.php";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
