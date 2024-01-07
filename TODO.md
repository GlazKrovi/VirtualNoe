Page web echo items of a (test user) (> User seeder)

use() functions in different items!


Inventory's current add and remove functions with Request could be
replaced by addItem and removeItem functions. This way, it's up to the caller or middleware
to retrieve the objects in request and give them as arguments if required 
(allowing several objects to be passed at once via this intermediary).
