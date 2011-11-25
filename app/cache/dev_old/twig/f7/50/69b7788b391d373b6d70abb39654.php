<?php

/* WebProfilerBundle:Profiler:results.html.twig */
class __TwigTemplate_f75069b7788b391d373b6d70abb39654 extends Twig_Template
{
    protected $parent;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = array();
        $this->blocks = array(
            'panel' => array($this, 'block_panel'),
        );
    }

    public function getParent(array $context)
    {
        $parent = "WebProfilerBundle:Profiler:layout.html.twig";
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
    public function block_panel($context, array $blocks = array())
    {
        // line 4
        echo "    <h2>Search Results</h2>

    ";
        // line 6
        if ($this->getContext($context, 'tokens')) {
            // line 7
            echo "        <table>
            <tr>
                <th>Token</th>
                <th>IP</th>
                <th>URL</th>
                <th>Time</th>
            </tr>
            ";
            // line 14
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getContext($context, 'tokens'));
            foreach ($context['_seq'] as $context['_key'] => $context['elements']) {
                // line 15
                echo "                <tr>
                    <td><a href=\"";
                // line 16
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("_profiler", array("token" => $this->getAttribute($this->getContext($context, 'elements'), "token", array(), "any", false))), "html");
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, 'elements'), "token", array(), "any", false), "html");
                echo "</a></td>
                    <td>";
                // line 17
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, 'elements'), "ip", array(), "any", false), "html");
                echo "</td>
                    <td>";
                // line 18
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, 'elements'), "url", array(), "any", false), "html");
                echo "</td>
                    <td>";
                // line 19
                echo twig_escape_filter($this->env, twig_date_format_filter($this->getAttribute($this->getContext($context, 'elements'), "time", array(), "any", false), "r"), "html");
                echo "</td>
                </tr>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['elements'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 22
            echo "        </table>
    ";
        } else {
            // line 24
            echo "        <p>
            <em>The query returned no result.</em>
        </p>
    ";
        }
        // line 28
        echo "
";
    }

    public function getTemplateName()
    {
        return "WebProfilerBundle:Profiler:results.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
