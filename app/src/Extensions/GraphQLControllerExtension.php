<?php

namespace XD\Basic\Extensions;

use SilverStripe\Control\Director;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Core\Extension;
use Silverstripe\GraphQL\Controller as GraphQLController;
use SilverStripe\Security\DefaultAdminService;
use SilverStripe\Security\Member;
use SilverStripe\Security\Security;

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

        if ($request->getHeader('X-Svelte')) {
            $this->owner->setCorsConfig(['Enabled' => false]);
        }
        

        // if (!Director::isLive()) {
        //     $service = DefaultAdminService::create();
        //     $admin = $service->findOrCreateDefaultAdmin();
        //     Security::setCurrentUser($admin);
            
        //     // $this->owner->setCorsConfig(['Enabled' => false]);
        // }
    }
}
