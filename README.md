# collection-26 — recodez la `Collection` de Laravel

Atelier du **chapitre 8** du bloc POO (5XCOS · BES Webdeveloper · IFOSUP Wavre).

Dans Laravel, `User::all()` ne vous renvoie pas un tableau : il vous renvoie une
`Collection`. Tant que `->map()`, `->filter()` et les callbacks (`fn`) restent
flous, la moitié de la documentation de Laravel reste illisible. Le meilleur
moyen de les rendre limpides, c'est de les écrire vous-même. C'est tout
l'atelier : trois étapes, une classe par étape, des tests déjà écrits.

## Démarrer

```bash
composer install
composer test
```

Tout est rouge : c'est normal. Chaque méthode de `src/` lève
`LogicException('À implémenter')` ; votre travail est de remplacer ces `throw`
par du vrai code, méthode par méthode, jusqu'à ce que la couleur change.

Pour ne lancer qu'une étape :

```bash
composer test -- --group=etape-1
composer test -- --group=etape-2
composer test -- --group=etape-3
composer test -- --group=bonus
```

## Les trois étapes

### Étape 1 — `Stack`, la pile (`src/Stack.php`)

Une pile d'assiettes : on pose sur le dessus, on reprend sur le dessus. LIFO,
*Last In, First Out*. Vous écrivez `push`, `pop`, `peek`, `isEmpty` et `count`
sur un simple tableau PHP.

À faire passer : `--group=etape-1`.
Notion nouvelle : l'interface native `Countable`, qui rend `count($stack)`
possible sur votre objet.

### Étape 2 — `ArrayList`, la liste (`src/ArrayList.php`)

Une liste indexée de 0 à `size()-1`, **sans trou** : après `remove(1)`, l'ancien
index 2 devient l'index 1. Vous implémentez le contrat `ListInterface`
(`src/ListInterface.php`, déjà écrit, à ne pas modifier) : `push`, `get`, `set`,
`remove`, `indexOf`, `includes`, `size`, `isEmpty`, `clear`, `toArray`,
`__toString`.

À faire passer : `--group=etape-2`.
Notion nouvelle : une interface est un contrat. `guardIndex()` vous est offerte.

### Étape 3 — `Collection`, la liste qui se transforme (`src/Collection.php`)

`Collection extends ArrayList` : tout ce que sait faire une liste est déjà là,
vous n'ajoutez que les transformations — `make`, `map`, `filter`, `reduce`,
`each`, `first`, `last`, `sum`, `pluck`, `sortBy`, `reverse` — plus `Countable`
et `IteratorAggregate`.

**La règle de l'étape** : une transformation ne modifie jamais la collection de
départ, elle en renvoie une **nouvelle**. C'est ce qui rend le chaînage possible :

```php
$poidsDesLourds = Collection::make($items)
    ->filter(fn (Item $item): bool => $item->weight >= 3.0)
    ->pluck('weight')
    ->sum();
```

À faire passer : `--group=etape-3`.
Notions nouvelles : les callbacks (`fn (...) => ...`), `IteratorAggregate` (qui
rend `foreach` possible sur votre objet), et `static::make()`.

### Bonus — `LinkedList` (`src/LinkedList.php`)

La même `ListInterface`, une mécanique opposée : des maillons (`Node`, déjà
écrit) qui pointent l'un vers l'autre. Les tests sont les mêmes qu'à l'étape 2 :
la démonstration qu'une interface décrit *ce qu'on peut faire*, pas *comment
c'est fait*.

Le job `bonus` de la CI n'est pas bloquant.

## L'ordre de travail conseillé

1. Lancez `composer test -- --group=etape-1`.
2. Lisez **le premier** test rouge, et lui seul.
3. Écrivez le minimum de code qui le fait passer.
4. Relancez. Recommencez.
5. Quand l'étape est verte : commit, push, et regardez l'onglet **Actions**.

La CI lance un job par étape : vous verrez trois coches (plus le bonus), vertes
ou rouges. C'est votre retour, il est gratuit et immédiat.

## Règles du jeu

- N'écrivez rien dans `tests/` : les tests sont le cahier des charges.
- Ne modifiez pas `ListInterface` : c'est le contrat.
- Bloqué plus de dix minutes ? Demandez une piste. Puis, si ça ne débloque pas,
  la solution expliquée. Dans cet ordre.

## Ce que ça donne dans Laravel

```php
// Votre Collection
Collection::make($items)->filter($leger)->pluck('name');

// Illuminate\Support\Collection
collect($items)->filter($leger)->pluck('name');
```

Même idée, mêmes noms, même règle du « ça renvoie une nouvelle collection ».
Vous ne lirez plus jamais `$users->map(...)` de la même façon.
