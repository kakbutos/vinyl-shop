<?php

namespace Eshop\src\Service;

class Validator
{
	private array $data;
	private array $errors = [];
	private array $messages;

	public function __construct() {
		$this->setMessagesDefault();
	}

	protected function setMessagesDefault(): void
	{
		$this->messages = array(
			'isRequired' => 'Поле "%s" не может быть пустым',
			'maxLength'  => '"%s" не может быть длиннее %s символов',
			'isEmail'    => 'Неверный формат email: %s',
			'isName'     => 'Имя "%s" содержит недопустимые символы',
			'isPhone'    => 'Неверный формат телефона: %s',
			'isNumber'   => 'Поле "%s" содержит недопустимые символы'
		);
	}

	protected function setError($error): void
	{
		$this->errors[$this->data['name']][] = $error;
	}

	public function set($name, $value): self
	{
		$this->data['name'] = $name;
		$this->data['value'] = $value;

		return $this;
	}

	public function isRequired(): self
	{
		$data = trim($this->data['value']);
		if (empty($data))
		{
			$this->setError(sprintf($this->messages['isRequired'], $this->data['name']));
		}

		return $this;
	}

	public function isEmail(): self
	{
		if (filter_var($this->data['value'], FILTER_VALIDATE_EMAIL) === false)
		{
			$this->setError(sprintf($this->messages['isEmail'], $this->data['value']));
		}

		return $this;
	}

	public function isPhone(): self
	{
		$phone = preg_replace('/[^+0-9]/', '', $this->data['value']);
		$template = '/^\s?(\+\s?7|8)([- ()]*\d){10}$/';

		$verify = preg_match($template, $phone);

		if(!$verify)
		{
			$this->setError(sprintf($this->messages['isPhone'], $this->data['value']));
		}

		return $this;
	}

	public function isName(): self
	{
		$template = '/^[a-zA-Zа-яА-ЯёЁ\s\-]+$/u';
		$verify = preg_match($template, $this->data['value']);

		if(!$verify)
		{
			$this->setError(sprintf($this->messages['isName'], $this->data['value']));
		}

		return $this;
	}

	public function maxLength($length): self
	{
		if (strlen($this->data['value']) > $length)
		{
			$this->setError(sprintf($this->messages['maxLength'], $this->data['name'], $length));
		}

		return $this;
	}

	public function validate(): bool
	{
		return (count($this->errors) > 0 ? false : true);
	}

	public function getErrors($param = false)
	{
		if ($param)
		{
			$textError = $this->errors[$param];
			return $textError ?? false;
		}

		return $this->errors;
	}

	public function isNumber(): self
	{
		$template = '/^\d+$/';
		$verify = preg_match($template, $this->data['value']);

		if(!$verify)
		{
			$this->setError(sprintf($this->messages['isNumber'], $this->data['value']));
		}

		return $this;
	}
}