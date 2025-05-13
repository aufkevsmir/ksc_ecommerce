<?php
class WebUser extends CWebUser
{
    public function isAdmin()
    {
        return $this->getState('role') === 'admin';
    }

    public function isSeller()
    {
        return $this->getState('role') === 'seller';
    }

    public function isBuyer()
    {
        return $this->getState('role') === 'buyer';
    }
}
