<?php

namespace XD\Basic\Extensions;

use SilverStripe\Control\Director;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Core\Extension;
use Silverstripe\GraphQL\Controller as GraphQLController;

/**
 * @property GraphQLController owner
 */
class GraphQLControllerExtension extends Extension
{
    public function beforeCallActionHandler(HTTPRequest $request, $action)
    {
        // remove cors on introspection
        if (!Director::isLive() && $request->getVar('introspection')) {
            $this->owner->setCorsConfig(['Enabled' => false]);
        }
    }
}
