<?php

namespace Oro\Bundle\MigrationBundle\EventListener;

use Symfony\Component\Console\Event\ConsoleCommandEvent;

class ConsoleCommandListener
{
    /**
     * @param ConsoleCommandEvent $event
     */
    public function onConsoleCommand(ConsoleCommandEvent $event)
    {
        if ('doctrine:schema:update' === $event->getCommand()->getName()) {
            /**
             * to disable automatic rename of autogenerated indices
             * we have to use "class_alias" to replace "Doctrine\DBAL\Schema\SchemaDiff"
             * with "Oro\Bundle\MigrationBundle\Migration\Schema\SchemaDiff"
             */
            if (!class_exists('Doctrine\DBAL\Schema\SchemaDiff', false)) {
                class_alias(
                    'Oro\Bundle\MigrationBundle\Migration\Schema\SchemaDiff',
                    'Doctrine\DBAL\Schema\SchemaDiff'
                );
            }
        }
    }
}
