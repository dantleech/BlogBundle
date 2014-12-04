<?php

/*
 * This file is part of the Symfony CMF package.
 *
 * (c) 2011-2014 Symfony CMF
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Symfony\Cmf\Bundle\BlogBundle\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

/**
* This class contains the configuration information for the bundle
*
* This information is solely responsible for how the different configuration
* sections are normalized, and merged.
*
* @author David Buchmann
*/
class Configuration implements ConfigurationInterface
{
    /**
     * Returns the config tree builder.
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $treeBuilder->root('cmf_blog')
            ->children()
                ->enumNode('use_sonata_admin')
                    ->values(array(true, false, 'auto'))
                    ->defaultValue('auto')
                ->end()

                ->arrayNode('integrate_menu')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->enumNode('enabled')
                            ->values(array(true, false, 'auto'))
                            ->defaultValue('auto')
                        ->end()
                        ->scalarNode('content_key')->defaultNull()->end()
                    ->end()
                ->end()
                ->scalarNode('blog_basepath')
                    ->isRequired()
                    ->defaultValue('/cms/blog')
                ->end()
                ->scalarNode('routing_post_controller') # unused
                    ->defaultValue('cmf_blog.blog_controller:viewPostAction')
                ->end()
                ->scalarNode('routing_post_prefix') # unused
                    ->defaultValue('posts')
                ->end()
                ->scalarNode('routing_tag_controller') # unused
                    ->defaultValue('cmf_blog.blog_controller:listAction')
                ->end()
                ->scalarNode('routing_tag_prefix') # unused
                    ->defaultValue('tag')
                ->end()
                ->arrayNode('class')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('blog_admin')
                            ->defaultValue('Symfony\Cmf\Bundle\BlogBundle\Admin\BlogAdmin')
                        ->end()
                        ->scalarNode('post_admin')
                            ->defaultValue('Symfony\Cmf\Bundle\BlogBundle\Admin\PostAdmin')
                        ->end()
                        ->scalarNode('blog')
                            ->defaultValue('Symfony\Cmf\Bundle\BlogBundle\Document\Blog')
                        ->end()
                        ->scalarNode('post')
                            ->defaultValue('Symfony\Cmf\Bundle\BlogBundle\Document\Post')
                        ->end()
                    ->end()
                ->end()
            ->end()
        ->end()
        ;

        return $treeBuilder;
    }
}
