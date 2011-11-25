<?php

/* ProtalkMediaBundle:Tag:list.html.twig */
class __TwigTemplate_fab6b24c5095c95ec574365bae679233 extends Twig_Template
{
    protected function doDisplay(array $context, array $blocks = array())
    {
        $context = array_merge($this->env->getGlobals(), $context);

        // line 1
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, 'tags'));
        foreach ($context['_seq'] as $context['_key'] => $context['tag']) {
            // line 2
            echo "  ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, 'tag'), "name", array(), "any", false), "html");
            echo "&nbsp;
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
    }

    public function getTemplateName()
    {
        return "ProtalkMediaBundle:Tag:list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
