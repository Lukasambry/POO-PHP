# POO-PHP

This project is a turn base game with OOP in PHP.

Quand vous travaillez en local sur votre ordinteur, peu importe les changements que vous faites, créer toujours une nouvelle branche de travail afin de pas péter la branche principale. Voyez ça comme un arbre. Le tronc ça sera MAIN et toutes les branches c'est vous qui les créez à côté et une fois fini, on vient les accrocher au tronc.

Pour créer une nouvelle branche : **"" git checkout -b "feat/(ou fix/) nom-de-votre-branche" ""** (convention de nommage, faites confiance ça vous servira)

Pour mettre le code ici :
Vérifier sur quelle branche on se trouve (écrit dans le terminal _Git Bash_)

1/ Faire un **"" git pull ""** pour mettre à jour les dernières modifications en date

2/ Ecrire son code de son côté (**sur *sa branche* svp)**

3/ Une fois terminé, ouvrir un terminal (Git bash)

4/ Taper la commande **"" git status ""**

5/ Voir les fichiers qui ont été modifiés

6/ Pour ajouter les changements : **"" git add . ""** (ou si vous voulez pas tout mettr d'un coup **git add "NomDuFichier"**)

7/ Mettre un message pour aider les autres à comprendre : **"" git commit -m "message à écrire" ""** (exemple: "feat/nom\_de\_votre\_feature" ou "fix/probleme\_de\_connexion")

8/ Enfin pour pousser le code jusqu'ici : **"" git push ""**
--> Si erreur : copier la ligne de commande qui apparait "git push --set-upstream origin ...."

9/ gg

Une fois que c'est fait vous ouvrez une **Pull Request / Merge Request** et comme ça on pourra la fusionner sur la branche MAIN (on fait toujours vérifier son travail par quelqu'un avant de fusionner sinon ça peut tout casser à cause des conflits)

10/ Pour revenir sur la branche principale MAIN une fois fini : **"" git checkout main ""**


Pré-requis du projet (syllabus) : 
1. Créez une classe Spell qui possède un nom,une description, un coût en mana

2. Implémentez un système d’éléments (eau, feu, plante) en triade (comme Pokemon) dans lequel L’eau bat le feu, le feu bat la plante et la plante bat l’eau.

3. Déclinez vos personnages pour avoir la possibilité d’en créer selon différents éléments.
Les dégats infligés par un personnage d’un élément, à un autre personnage d’un autre élément, ont un bonus ou un malus en fonction de leur position dans la triade.
(ex: un Personnage de feu qui attaque un Personnage d’eau fera moins de dégat que si il attaquait un Personnage plante)

4. Créez différents Spell :
sort de défense (Bonus de défense pour le personnage qui équipe le sort)
sort de dégats (inflige des dégats physiques ou magiques au lieu d'attaquer
avec son arme, (ce sort utilise 1 tour)
sort de soin (Soigne le personnage, ce sort utilise 1 tour et le personnage ne
peut donc pas attaquer s'il se soigne)

5. Modifiez vos personnages pour qu'en plus de l'arme, ils puissent équiper 3 sorts (1
de défense, 1 d'attaque et 1 de soin) et donc aient un montant de mana donné qui
est régénéré un peu à chaque fin de tour

6. Modifiez votre boucle de jeu pour que les personnages utilisent leurs sorts (par
exemple si il tombe sous 15% de vie il se soigne au lieu d'attaquer, ou si il possède
assez de mana pour utiliser son sort d'attaque ou de défense)

**BONUS (si vous avez le temps et l’envie)**

1. Faites en sortes que vos personnages aient des niveaux et des points
d’expériences leur permettant de monter de niveau. Ces niveaux ont une influence
sur leurs statistiques (dégats, défense, hp max, dégats des sorts). L’expérience est
acquise au cours des différents rounds.

**BONUS ENCORE PLUS BONUS (si vous avez encore plus de temps et encore plus l’envie)**

1. Changez la boucle de jeu de manière à ce que je puisse choisir mon personnage
(voir: https://www.php.net/manual/en/function.readline.php).

2. Je souhaite donc
a. Choisir mon personnage
b. Me battre aléatoirement contre 1 adversaire
c. Choisir mes attaques ou mes sorts

