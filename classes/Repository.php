<?php


interface Repository
{

    public function getObjectsFromQuery(QueryInterface $query): array;

}