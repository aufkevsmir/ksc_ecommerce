<?php

class UserIdentity extends CUserIdentity
{
	private $_id;

	public function authenticate()
	{
		$user = Users::model()->findByAttributes(['email' => $this->username]);

		if ($user === null) {
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		} elseif (!CPasswordHelper::verifyPassword($this->password, $user->password_hash)) {
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		} else {
			$this->_id = $user->id;
			$this->setState('name', $user->full_name);
			$this->setState('role', $user->role);
			$this->errorCode = self::ERROR_NONE;
		}

		return !$this->errorCode;
	}

	public function getId()
	{
		return $this->_id;
	}
}

