<?php

/* index.php */
class __TwigTemplate_82256e4fd06c9e8575b723b4d411c99a extends Twig_Template
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
        echo "<html>
<head>
\t<title>Testing</title>
</head>
<body>
\t<h1>This is a test of the views.</h1>
\t<p>I am testing. <?php echo 'hey' ?></p>
</body>
</html>";
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
