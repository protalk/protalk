<?php

/* WebProfilerBundle:Profiler:bag.html.twig */
class __TwigTemplate_214f78b36189f1c78ec4eb84bdd4a9fa extends Twig_Template
{
    protected function doDisplay(array $context, array $blocks = array())
    {
        $context = array_merge($this->env->getGlobals(), $context);

        // line 1
        echo "<table>
    <tr>
        <th>Key</th>
        <th>Value</th>
    </tr>
    ";
        // line 6
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable(twig_sort_filter($this->getAttribute($this->getContext($context, 'bag'), "keys", array(), "any", false)));
        foreach ($context['_seq'] as $context['_key'] => $context['key']) {
            // line 7
            echo "        <tr>
            <th>";
            // line 8
            echo twig_escape_filter($this->env, $this->getContext($context, 'key'), "html");
            echo "</th>
            <td>";
            // line 9
            echo twig_escape_filter($this->env, $this->env->getExtension('yaml')->dump($this->getAttribute($this->getContext($context, 'bag'), "get", array($this->getContext($context, 'key'), ), "method", false)), "html");
            echo "</td>
        </tr>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['key'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 12
        echo "</table>
";
    }

    public function getTemplateName()
    {
        return "WebProfilerBundle:Profiler:bag.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
