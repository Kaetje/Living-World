<?php


interface Repository
{

    public function getObjectsFromQuery(Query $query): array;

}