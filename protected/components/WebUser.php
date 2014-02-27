<?php
class WebUser extends CWebUser
{
    /**
     * Overrides a Yii method that is used for roles in controllers (accessRules).
     *
     * @param string $operation Name of the operation required (here, a role).
     * @param mixed $params (opt) Parameters for this operation, usually the object to access.
     * @return bool Permission granted?
     */
    public function checkAccess($operation, $params = array())
    {
        $this->loginUrl = Yii::app()->createUrl('/admin/default/login');
        if (empty($this->id))
        {
            $this->setState('roles', 'guest');
        }
        $role = $this->getState("roles");
        if ($role === 'admin')
        {
            return true; // admin role has access to everything
        }

        // allow access if the operation request is the current user's role
        return ($operation === $role);
    }
}