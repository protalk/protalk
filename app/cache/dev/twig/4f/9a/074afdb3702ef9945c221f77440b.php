<?php

/* ProtalkPageBundle:Page:index.html.twig */
class __TwigTemplate_4f9a074afdb3702ef9945c221f77440b extends Twig_Template
{
    protected $parent;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = array();
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
        );
    }

    public function getParent(array $context)
    {
        $parent = "::base.html.twig";
        if ($parent instanceof Twig_Template) {
            $name = $parent->getTemplateName();
            $this->parent[$name] = $parent;
            $parent = $name;
        } elseif (!isset($this->parent[$parent])) {
            $this->parent[$parent] = $this->env->loadTemplate($parent);
        }

        return $this->parent[$parent];
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $context = array_merge($this->env->getGlobals(), $context);

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, 'page'), "pagetitle", array(), "any", false), "html");
    }

    // line 4
    public function block_body($context, array $blocks = array())
    {
        // line 5
        echo "  <div style=\"float: left; width: 500px;\">

  <h1>";
        // line 7
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, 'page'), "title", array(), "any", false), "html");
        echo "</h1>
  ";
        // line 8
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, 'page'), "content", array(), "any", false), "html");
        echo "
  </div>

  <div style=\"float:left; width:200px;\">
    ";
        // line 12
        echo $this->env->getExtension('actions')->renderAction("ProtalkMediaBundle:Tag:list", array(), array());
        // line 13
        echo "  </div>
";
    }

    public function getTemplateName()
    {
        return "ProtalkPageBundle:Page:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
