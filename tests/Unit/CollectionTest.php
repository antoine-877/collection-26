<?php

declare(strict_types=1);

use Collections\ArrayList;
use Collections\Collection;
use Tests\Fixtures\Item;

/** Le contenu du sac d'Arthur : quatre objets, quatre poids. */
function butin(): Collection
{
    return Collection::make([
        new Item('Épée longue', 3.5),
        new Item('Potion de soin', 0.5),
        new Item('Bouclier', 6.0),
        new Item('Torche', 1.0),
    ]);
}

describe('Étape 3 — Collection', function (): void {
    it('hérite d\'ArrayList', function (): void {
        expect(new Collection())->toBeInstanceOf(ArrayList::class);
    });

    it('se fabrique depuis un tableau avec make()', function (): void {
        $heros = Collection::make(['Arthur', 'Perceval', 'Merlin']);

        expect($heros->size())->toBe(3)
            ->and($heros->get(0))->toBe('Arthur')
            ->and($heros->toArray())->toBe(['Arthur', 'Perceval', 'Merlin']);
    });

    it('make() sans argument donne une collection vide', function (): void {
        expect(Collection::make()->isEmpty())->toBeTrue();
    });

    it('map() transforme chaque élément', function (): void {
        $cris = Collection::make(['Arthur', 'Merlin'])
            ->map(fn (string $nom): string => mb_strtoupper($nom));

        expect($cris->toArray())->toBe(['ARTHUR', 'MERLIN']);
    });

    it('map() renvoie une NOUVELLE collection et ne touche pas l\'originale', function (): void {
        $heros = Collection::make(['Arthur', 'Merlin']);
        $cris = $heros->map(fn (string $nom): string => mb_strtoupper($nom));

        expect($cris)->toBeInstanceOf(Collection::class)
            ->and($cris)->not->toBe($heros)
            ->and($heros->toArray())->toBe(['Arthur', 'Merlin']);
    });

    it('filter() garde ce qui passe le test et renumérote les index', function (): void {
        $legers = butin()->filter(fn (Item $item): bool => $item->weight < 2.0);

        expect($legers->size())->toBe(2)
            ->and($legers->get(0)->name)->toBe('Potion de soin')
            ->and($legers->get(1)->name)->toBe('Torche');
    });

    it('filter() peut ne rien garder', function (): void {
        expect(butin()->filter(fn (Item $item): bool => $item->weight > 100)->isEmpty())->toBeTrue();
    });

    it('reduce() accumule vers une seule valeur', function (): void {
        $poids = butin()->reduce(
            fn (float $total, Item $item): float => $total + $item->weight,
            0.0
        );

        expect($poids)->toBe(11.0);
    });

    it('reduce() sert aussi à construire une phrase', function (): void {
        $phrase = Collection::make(['Arthur', 'Merlin'])
            ->reduce(fn (string $acc, string $nom): string => $acc . $nom . ' ', '');

        expect($phrase)->toBe('Arthur Merlin ');
    });

    it('each() exécute le callback et renvoie la collection', function (): void {
        $vus = [];
        $heros = Collection::make(['Arthur', 'Merlin']);
        $retour = $heros->each(function (string $nom) use (&$vus): void {
            $vus[] = $nom;
        });

        expect($vus)->toBe(['Arthur', 'Merlin'])
            ->and($retour)->toBe($heros);
    });

    it('first() et last() sans callback', function (): void {
        $heros = Collection::make(['Arthur', 'Perceval', 'Merlin']);

        expect($heros->first())->toBe('Arthur')
            ->and($heros->last())->toBe('Merlin');
    });

    it('first() et last() avec un callback', function (): void {
        $sac = butin();

        expect($sac->first(fn (Item $item): bool => $item->weight > 1.0)->name)->toBe('Épée longue')
            ->and($sac->last(fn (Item $item): bool => $item->weight > 1.0)->name)->toBe('Bouclier');
    });

    it('first() et last() renvoient null quand il n\'y a rien', function (): void {
        expect(Collection::make()->first())->toBeNull()
            ->and(Collection::make()->last())->toBeNull()
            ->and(butin()->first(fn (Item $item): bool => $item->weight > 100))->toBeNull();
    });

    it('sum() additionne des nombres', function (): void {
        expect(Collection::make([1, 2, 3, 4])->sum())->toBe(10)
            ->and(Collection::make()->sum())->toBe(0);
    });

    it('sum() additionne le résultat d\'un callback', function (): void {
        expect(butin()->sum(fn (Item $item): float => $item->weight))->toBe(11.0);
    });

    it('pluck() extrait une propriété d\'objet', function (): void {
        expect(butin()->pluck('name')->toArray())
            ->toBe(['Épée longue', 'Potion de soin', 'Bouclier', 'Torche']);
    });

    it('pluck() extrait aussi une clé de tableau', function (): void {
        $sac = Collection::make([
            ['name' => 'Épée longue', 'weight' => 3.5],
            ['name' => 'Torche', 'weight' => 1.0],
        ]);

        expect($sac->pluck('weight')->toArray())->toBe([3.5, 1.0]);
    });

    it('sortBy() trie sans modifier l\'originale', function (): void {
        $sac = butin();
        $tries = $sac->sortBy(fn (Item $item): float => $item->weight);

        expect($tries->pluck('name')->toArray())
            ->toBe(['Potion de soin', 'Torche', 'Épée longue', 'Bouclier'])
            ->and($sac->get(0)->name)->toBe('Épée longue');
    });

    it('reverse() inverse sans modifier l\'originale', function (): void {
        $heros = Collection::make(['Arthur', 'Perceval', 'Merlin']);

        expect($heros->reverse()->toArray())->toBe(['Merlin', 'Perceval', 'Arthur'])
            ->and($heros->toArray())->toBe(['Arthur', 'Perceval', 'Merlin']);
    });

    it('se chaîne : filter puis pluck puis sum', function (): void {
        $poidsDesLourds = butin()
            ->filter(fn (Item $item): bool => $item->weight >= 3.0)
            ->pluck('weight')
            ->sum();

        expect($poidsDesLourds)->toBe(9.5);
    });

    it('se chaîne encore : tri, inversion, noms', function (): void {
        $noms = butin()
            ->sortBy(fn (Item $item): float => $item->weight)
            ->reverse()
            ->pluck('name')
            ->toArray();

        expect($noms)->toBe(['Bouclier', 'Épée longue', 'Torche', 'Potion de soin']);
    });

    it('est Countable : count($collection) fonctionne', function (): void {
        expect(butin())->toBeInstanceOf(Countable::class)
            ->and(count(butin()))->toBe(4);
    });

    it('est IteratorAggregate : foreach fonctionne', function (): void {
        $noms = [];

        foreach (butin() as $item) {
            $noms[] = $item->name;
        }

        expect(butin())->toBeInstanceOf(IteratorAggregate::class)
            ->and($noms)->toBe(['Épée longue', 'Potion de soin', 'Bouclier', 'Torche']);
    });

    it('hérite des méthodes d\'ArrayList', function (): void {
        $heros = Collection::make(['Arthur', 'Merlin']);
        $heros->push('Perceval');

        expect($heros->size())->toBe(3)
            ->and($heros->indexOf('Merlin'))->toBe(1)
            ->and($heros->includes('Perceval'))->toBeTrue()
            ->and((string) $heros)->toBe("[\n    \"Arthur\",\n    \"Merlin\",\n    \"Perceval\"\n]");
    });
})->group('etape-3');
