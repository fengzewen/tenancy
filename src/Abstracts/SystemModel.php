<?php


namespace Xpsaas\Tenancy\Abstracts;

use Xpsaas\Tenancy\Traits\UsesSystemConnection;

abstract class SystemModel extends AbstractModel
{
    use UsesSystemConnection;
}
