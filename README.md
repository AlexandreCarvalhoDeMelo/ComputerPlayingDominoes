# Dominoes

Hope you guys like
It was very fun to do! : )

Requirements: 
* PHP 7.1
* PHPUnit (dev)

### Installation

Just run composer install:
```
composer install
```

Run
```
php game.php Elke Heidi Tom Luca
```

Note: Up tp four players.

###Sample output
```
Gaming starting with <4:5>
Elke will play <2:4> connecting with <4:5>
Board now is <2:4> <4:5>
Luca will play <6:2> connecting with <2:4>
Board now is <6:2> <2:4> <4:5>
Heidi will play <1:6> connecting with <6:2>
Board now is <1:6> <6:2> <2:4> <4:5>
Tom will play <5:5> connecting with <4:5>
Board now is <1:6> <6:2> <2:4> <4:5> <5:5>
Elke will play <5:6> connecting with <5:5>
Board now is <1:6> <6:2> <2:4> <4:5> <5:5> <5:6>
Luca will play <4:1> connecting with <1:6>
Board now is <4:1> <1:6> <6:2> <2:4> <4:5> <5:5> <5:6>
Heidi will play <4:4> connecting with <4:1>
Board now is <4:4> <4:1> <1:6> <6:2> <2:4> <4:5> <5:5> <5:6>
Elke will play <0:4> connecting with <4:4>
Board now is <0:4> <4:4> <4:1> <1:6> <6:2> <2:4> <4:5> <5:5> <5:6>
Luca will play <6:0> connecting with <0:4>
Board now is <6:0> <0:4> <4:4> <4:1> <1:6> <6:2> <2:4> <4:5> <5:5> <5:6>
Heidi will play <4:6> connecting with <6:0>
Board now is <4:6> <6:0> <0:4> <4:4> <4:1> <1:6> <6:2> <2:4> <4:5> <5:5> <5:6>
Elke will play <6:6> connecting with <5:6>
Board now is <4:6> <6:0> <0:4> <4:4> <4:1> <1:6> <6:2> <2:4> <4:5> <5:5> <5:6> <6:6>
Luca will play <6:3> connecting with <6:6>
Board now is <4:6> <6:0> <0:4> <4:4> <4:1> <1:6> <6:2> <2:4> <4:5> <5:5> <5:6> <6:6> <6:3>
Heidi will play <3:1> connecting with <6:3>
Board now is <4:6> <6:0> <0:4> <4:4> <4:1> <1:6> <6:2> <2:4> <4:5> <5:5> <5:6> <6:6> <6:3> <3:1>
Tom will play <1:2> connecting with <3:1>
Board now is <4:6> <6:0> <0:4> <4:4> <4:1> <1:6> <6:2> <2:4> <4:5> <5:5> <5:6> <6:6> <6:3> <3:1> <1:2>
Elke will play <2:3> connecting with <1:2>
Board now is <4:6> <6:0> <0:4> <4:4> <4:1> <1:6> <6:2> <2:4> <4:5> <5:5> <5:6> <6:6> <6:3> <3:1> <1:2> <2:3>
Luca will play <3:4> connecting with <4:6>
Board now is <3:4> <4:6> <6:0> <0:4> <4:4> <4:1> <1:6> <6:2> <2:4> <4:5> <5:5> <5:6> <6:6> <6:3> <3:1> <1:2> <2:3>
Heidi will play <5:3> connecting with <3:4>
Board now is <5:3> <3:4> <4:6> <6:0> <0:4> <4:4> <4:1> <1:6> <6:2> <2:4> <4:5> <5:5> <5:6> <6:6> <6:3> <3:1> <1:2> <2:3>
Tom will play <3:3> connecting with <2:3>
Board now is <5:3> <3:4> <4:6> <6:0> <0:4> <4:4> <4:1> <1:6> <6:2> <2:4> <4:5> <5:5> <5:6> <6:6> <6:3> <3:1> <1:2> <2:3> <3:3>
Elke will play <1:5> connecting with <5:3>
Board now is <1:5> <5:3> <3:4> <4:6> <6:0> <0:4> <4:4> <4:1> <1:6> <6:2> <2:4> <4:5> <5:5> <5:6> <6:6> <6:3> <3:1> <1:2> <2:3> <3:3>
Luca will play <1:1> connecting with <1:5>
Board now is <1:1> <1:5> <5:3> <3:4> <4:6> <6:0> <0:4> <4:4> <4:1> <1:6> <6:2> <2:4> <4:5> <5:5> <5:6> <6:6> <6:3> <3:1> <1:2> <2:3> <3:3>
Elke will play <3:0> connecting with <3:3>
Board now is <1:1> <1:5> <5:3> <3:4> <4:6> <6:0> <0:4> <4:4> <4:1> <1:6> <6:2> <2:4> <4:5> <5:5> <5:6> <6:6> <6:3> <3:1> <1:2> <2:3> <3:3> <3:0>
Luca will play <0:1> connecting with <1:1>
Board now is <0:1> <1:1> <1:5> <5:3> <3:4> <4:6> <6:0> <0:4> <4:4> <4:1> <1:6> <6:2> <2:4> <4:5> <5:5> <5:6> <6:6> <6:3> <3:1> <1:2> <2:3> <3:3> <3:0>
Heidi will play <0:0> connecting with <0:1>
Board now is <0:0> <0:1> <1:1> <1:5> <5:3> <3:4> <4:6> <6:0> <0:4> <4:4> <4:1> <1:6> <6:2> <2:4> <4:5> <5:5> <5:6> <6:6> <6:3> <3:1> <1:2> <2:3> <3:3> <3:0>
Tom will play <5:0> connecting with <0:0>
Board now is <5:0> <0:0> <0:1> <1:1> <1:5> <5:3> <3:4> <4:6> <6:0> <0:4> <4:4> <4:1> <1:6> <6:2> <2:4> <4:5> <5:5> <5:6> <6:6> <6:3> <3:1> <1:2> <2:3> <3:3> <3:0>
Elke Won!
Done!

```
Note: The won message changes in case of draws
```
We Elke and Tom Won! a draw with 4 pieces.
```

####note
I can see how this code could be more efficient and robust
would greatly like to talk about it, 
