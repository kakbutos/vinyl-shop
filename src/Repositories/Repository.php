<?php

namespace Eshop\src\Repositories;

abstract class Repository
{
	abstract public function getList(array $filter): array;

	abstract public function getOneById(int $id);

	abstract public function add($entity): void;

	abstract public function delete($entity): void;

	abstract public function update($entity): void;
}