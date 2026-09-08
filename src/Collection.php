<?php

declare(strict_types=1);

namespace Collections;

use Countable;
use IteratorAggregate;
use LogicException;
use Traversable;

/**
 * ÉTAPE 3 — Une liste qui sait se transformer.
 *
 * `Collection` hérite de tout `ArrayList` (push, get, size, toArray,
 * __toString) : ne recopiez rien, tout est déjà là. Vous n'ajoutez que les
 * transformations, celles que vous croiserez tous les jours dans Laravel.
 *
 * LA règle de l'étape : **une transformation ne modifie jamais la collection
 * de départ, elle en renvoie une nouvelle**. C'est ce qui permet le chaînage :
 *
 *     Collection::make($items)
 *         ->filter(fn (Item $item): bool => $item->weight < 5.0)
 *         ->pluck('name');
 *
 * Une fois `make()` écrite, toutes les autres méthodes tiennent en trois
 * lignes : on construit un tableau `$resultat`, on renvoie
 * `static::make($resultat)`.
 *
 * Tests : `composer test -- --group=etape-3`
 */
class Collection extends ArrayList implements Countable, IteratorAggregate
{
    /**
     * Fabrique une collection à partir d'un tableau.
     *
     * L'équivalent du `collect([...])` de Laravel. Méthode statique : on
     * l'appelle sur la classe, pas sur un objet (`Collection::make([...])`),
     * comme `Dice::d6()` au chapitre 1.
     *
     * @param array<int, mixed> $elements
     */
    public static function make(array $elements = []): static
    {
        // TODO : créer une collection (`new static()`) et y pousser chaque élément.
        throw new LogicException('À implémenter');
    }

    /**
     * Applique le callback à chaque élément et renvoie une NOUVELLE collection.
     *
     * @param callable(mixed): mixed $callback
     */
    public function map(callable $callback): static
    {
        // TODO : $callback($element) s'appelle comme une fonction normale.
        throw new LogicException('À implémenter');
    }

    /**
     * Garde les éléments pour lesquels le callback renvoie true.
     * Les index de la nouvelle collection repartent de 0.
     *
     * @param callable(mixed): bool $callback
     */
    public function filter(callable $callback): static
    {
        throw new LogicException('À implémenter');
    }

    /**
     * Réduit la collection à une seule valeur, en accumulant de gauche à droite.
     *
     * Le callback reçoit deux arguments dans cet ordre : (accumulateur, élément).
     *
     * @param callable(mixed, mixed): mixed $callback
     */
    public function reduce(callable $callback, mixed $initial = null): mixed
    {
        // TODO : une variable $accumulateur, une boucle, un return.
        throw new LogicException('À implémenter');
    }

    /**
     * Exécute le callback sur chaque élément, pour l'effet de bord (afficher,
     * enregistrer…). Ne transforme rien : renvoie la collection elle-même.
     *
     * @param callable(mixed): void $callback
     */
    public function each(callable $callback): static
    {
        // TODO : attention, ici on renvoie $this (c'est la seule méthode
        // de cette classe qui ne crée pas une nouvelle collection).
        throw new LogicException('À implémenter');
    }

    /**
     * Premier élément, ou premier élément qui satisfait le callback.
     * Renvoie null si la collection est vide ou si rien ne correspond.
     *
     * @param null|callable(mixed): bool $callback
     */
    public function first(?callable $callback = null): mixed
    {
        throw new LogicException('À implémenter');
    }

    /**
     * Dernier élément, ou dernier élément qui satisfait le callback.
     *
     * @param null|callable(mixed): bool $callback
     */
    public function last(?callable $callback = null): mixed
    {
        // TODO : array_reverse() évite d'écrire une deuxième boucle.
        throw new LogicException('À implémenter');
    }

    /**
     * Somme des éléments, ou somme des valeurs renvoyées par le callback.
     * Une collection vide fait 0.
     *
     * @param null|callable(mixed): (float|int) $callback
     */
    public function sum(?callable $callback = null): float|int
    {
        throw new LogicException('À implémenter');
    }

    /**
     * Extrait une propriété (objet) ou une clé (tableau) de chaque élément.
     *
     * `$sac->pluck('name')` renvoie la collection des noms.
     * Indice : réutilisez map(). `$element->{$key}` lit une propriété dont le
     * nom est dans une variable ; `?? null` évite l'erreur si elle n'existe pas.
     */
    public function pluck(string $key): static
    {
        throw new LogicException('À implémenter');
    }

    /**
     * Trie par ordre croissant de la valeur renvoyée par le callback.
     * Renvoie une nouvelle collection : l'originale garde son ordre.
     *
     * Indice : copiez le tableau, `usort()` avec l'opérateur `<=>`, puis
     * `static::make()`.
     *
     * @param callable(mixed): mixed $callback
     */
    public function sortBy(callable $callback): static
    {
        throw new LogicException('À implémenter');
    }

    /** Renvoie une nouvelle collection dans l'ordre inverse. */
    public function reverse(): static
    {
        throw new LogicException('À implémenter');
    }

    /** Countable : c'est ce qui rend `count($collection)` possible. */
    public function count(): int
    {
        throw new LogicException('À implémenter');
    }

    /**
     * IteratorAggregate : c'est ce qui rend `foreach ($collection as $x)`
     * possible. Renvoyez un `ArrayIterator` construit sur $this->elements.
     *
     * @return Traversable<int, mixed>
     */
    public function getIterator(): Traversable
    {
        throw new LogicException('À implémenter');
    }
}
