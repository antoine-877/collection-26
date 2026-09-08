<?php

declare(strict_types=1);

namespace Collections;

use Stringable;

/**
 * Le contrat d'une liste : ce qu'on peut faire avec, sans dire comment.
 *
 * `ArrayList` et `LinkedList` remplissent ce contrat de deux façons
 * complètement différentes. Le code qui type sur `ListInterface` s'en moque.
 */
interface ListInterface extends Stringable
{
    /** Ajoute un élément à la fin. */
    public function push(mixed $element): void;

    /** Retourne l'élément à l'index donné. */
    public function get(int $index): mixed;

    /** Remplace l'élément à l'index donné. */
    public function set(int $index, mixed $element): void;

    /** Retire l'élément à l'index donné ; les suivants se décalent. */
    public function remove(int $index): void;

    /** Index du premier élément identique (===), ou -1 s'il est absent. */
    public function indexOf(mixed $element): int;

    /** L'élément est-il présent ? */
    public function includes(mixed $element): bool;

    /** Nombre d'éléments. */
    public function size(): int;

    /** La liste est-elle vide ? */
    public function isEmpty(): bool;

    /** Vide la liste. */
    public function clear(): void;

    /** @return list<mixed> Les éléments sous forme de tableau PHP. */
    public function toArray(): array;

    /** Représentation lisible, pratique pour déboguer. */
    public function __toString(): string;
}
