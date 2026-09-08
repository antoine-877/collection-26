<?php

declare(strict_types=1);

namespace Collections;

use LogicException;
use OutOfRangeException;

/**
 * ÉTAPE 2 — Une liste construite sur un tableau PHP.
 *
 * Les éléments sont rangés côte à côte, indexés de 0 à size()-1, **sans trou** :
 * après un `remove(1)`, l'ancien index 2 devient l'index 1. C'est ce qui rend
 * l'accès par index immédiat (O(1)) et la suppression au milieu coûteuse (O(n)).
 *
 * Indices :
 * - `array_splice()` retire un élément ET renumérote les suivants ;
 * - `array_search($x, $tableau, true)` cherche avec `===` et renvoie `false`
 *   si l'élément est absent (attention : `false`, pas `-1`) ;
 * - `guardIndex()` est déjà écrite plus bas : appelez-la avant tout accès.
 *
 * Tests : `composer test -- --group=etape-2`
 */
class ArrayList implements ListInterface
{
    /** @var list<mixed> Les éléments. `protected` : Collection en héritera. */
    protected array $elements = [];

    public function push(mixed $element): void
    {
        // TODO : ajouter à la fin.
        throw new LogicException('À implémenter');
    }

    public function get(int $index): mixed
    {
        // TODO : vérifier l'index, puis renvoyer l'élément.
        throw new LogicException('À implémenter');
    }

    public function set(int $index, mixed $element): void
    {
        // TODO : vérifier l'index, puis remplacer l'élément.
        throw new LogicException('À implémenter');
    }

    public function remove(int $index): void
    {
        // TODO : vérifier l'index, puis retirer SANS laisser de trou.
        throw new LogicException('À implémenter');
    }

    public function indexOf(mixed $element): int
    {
        // TODO : renvoyer l'index, ou -1 si l'élément est absent.
        throw new LogicException('À implémenter');
    }

    public function includes(mixed $element): bool
    {
        // TODO : une ligne, en réutilisant indexOf().
        throw new LogicException('À implémenter');
    }

    public function size(): int
    {
        throw new LogicException('À implémenter');
    }

    public function isEmpty(): bool
    {
        throw new LogicException('À implémenter');
    }

    public function clear(): void
    {
        throw new LogicException('À implémenter');
    }

    /** @return list<mixed> */
    public function toArray(): array
    {
        throw new LogicException('À implémenter');
    }

    public function __toString(): string
    {
        // TODO : du JSON indenté. Le test attend exactement la sortie de
        // json_encode() avec JSON_PRETTY_PRINT et JSON_UNESCAPED_UNICODE.
        throw new LogicException('À implémenter');
    }

    /**
     * Cadeau de la maison : vérifie qu'un index existe. Rien à écrire ici.
     *
     * @throws OutOfRangeException si l'index sort de la liste
     */
    protected function guardIndex(int $index): void
    {
        if ($index < 0 || $index >= count($this->elements)) {
            throw new OutOfRangeException("L'index {$index} n'existe pas dans cette liste.");
        }
    }
}
