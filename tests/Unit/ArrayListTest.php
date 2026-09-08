<?php

declare(strict_types=1);

use Collections\ArrayList;
use Collections\ListInterface;
use Tests\Fixtures\Item;

/** Les quatre héros du Donjon, utilisés par presque tous les tests. */
function heros(): ArrayList
{
    $liste = new ArrayList();
    $liste->push('Arthur');
    $liste->push('Perceval');
    $liste->push('Merlin');
    $liste->push('Guenièvre');

    return $liste;
}

describe('Étape 2 — ArrayList', function (): void {
    it('respecte le contrat ListInterface', function (): void {
        expect(new ArrayList())->toBeInstanceOf(ListInterface::class);
    });

    it('démarre vide', function (): void {
        $liste = new ArrayList();

        expect($liste->isEmpty())->toBeTrue()
            ->and($liste->size())->toBe(0)
            ->and($liste->toArray())->toBe([]);
    });

    it('ajoute des éléments à la fin et les relit par index', function (): void {
        $liste = heros();

        expect($liste->size())->toBe(4)
            ->and($liste->isEmpty())->toBeFalse()
            ->and($liste->get(0))->toBe('Arthur')
            ->and($liste->get(3))->toBe('Guenièvre');
    });

    it('remplace un élément avec set()', function (): void {
        $liste = heros();
        $liste->set(1, 'Lancelot');

        expect($liste->get(1))->toBe('Lancelot')
            ->and($liste->size())->toBe(4);
    });

    it('retire un élément et décale les suivants', function (): void {
        $liste = heros();
        $liste->remove(1);

        expect($liste->size())->toBe(3)
            ->and($liste->toArray())->toBe(['Arthur', 'Merlin', 'Guenièvre']);
    });

    it('trouve l\'index d\'un élément, ou -1', function (): void {
        $liste = heros();

        expect($liste->indexOf('Merlin'))->toBe(2)
            ->and($liste->indexOf('Mordred'))->toBe(-1);
    });

    it('compare avec === : "2" n\'est pas 2', function (): void {
        $liste = new ArrayList();
        $liste->push(2);

        expect($liste->indexOf('2'))->toBe(-1)
            ->and($liste->includes('2'))->toBeFalse()
            ->and($liste->includes(2))->toBeTrue();
    });

    it('dit si un élément est présent', function (): void {
        $liste = heros();

        expect($liste->includes('Arthur'))->toBeTrue()
            ->and($liste->includes('Mordred'))->toBeFalse();
    });

    it('se vide avec clear()', function (): void {
        $liste = heros();
        $liste->clear();

        expect($liste->size())->toBe(0)
            ->and($liste->isEmpty())->toBeTrue()
            ->and($liste->toArray())->toBe([]);
    });

    it('se convertit en tableau PHP sans trou dans les index', function (): void {
        $liste = heros();
        $liste->remove(0);
        $liste->remove(0);

        expect($liste->toArray())->toBe(['Merlin', 'Guenièvre']);
    });

    it('s\'affiche en JSON lisible', function (): void {
        $liste = new ArrayList();
        $liste->push('Arthur');
        $liste->push('Merlin');

        expect((string) $liste)->toBe("[\n    \"Arthur\",\n    \"Merlin\"\n]");
    });

    it('range aussi des objets', function (): void {
        $sac = new ArrayList();
        $epee = new Item('Épée longue', 3.5);
        $sac->push($epee);
        $sac->push(new Item('Potion', 0.5));

        expect($sac->size())->toBe(2)
            ->and($sac->get(0))->toBe($epee)
            ->and($sac->get(1)->name)->toBe('Potion')
            ->and($sac->includes($epee))->toBeTrue();
    });

    it('supporte 100 ajouts puis 100 retraits', function (): void {
        $liste = new ArrayList();

        for ($i = 0; $i < 100; ++$i) {
            $liste->push($i);
        }

        expect($liste->size())->toBe(100);

        for ($i = 0; $i < 100; ++$i) {
            $liste->remove(0);
        }

        expect($liste->isEmpty())->toBeTrue();
    });

    it('refuse un get() hors limites', function (): void {
        heros()->get(9);
    })->throws(OutOfRangeException::class);

    it('refuse un get() négatif', function (): void {
        heros()->get(-1);
    })->throws(OutOfRangeException::class);

    it('refuse un set() hors limites', function (): void {
        heros()->set(9, 'Mordred');
    })->throws(OutOfRangeException::class);

    it('refuse un remove() hors limites', function (): void {
        heros()->remove(9);
    })->throws(OutOfRangeException::class);

    it('refuse un get() sur une liste vide', function (): void {
        (new ArrayList())->get(0);
    })->throws(OutOfRangeException::class);
})->group('etape-2');
