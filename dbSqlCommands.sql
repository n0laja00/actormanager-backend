SELECT *
from game inner join world on game.id = world.gameId
	inner join continent on continent.worldId = world.id
    inner join continentnation on continentnation.continentId = continent.id
    inner join nation on continentnation.nationId = nation.id
    inner join city on city.nationId = nation.id
    inner join cityorganisation on cityorganisation.cityId = city.id
    inner join organisation on cityorganisation.organisationId = organisation.id
    inner join powerpyramid on organisation.id = powerpyramid.organisationId
    inner join actor on powerpyramid.actorId = actor.id
    inner join power on powerpyramid.powerId = power.id


/*Select act game and actor + organisation + power.level and description*/
SELECT game.name "Game name", nation.name as "Country", city.name as "City", actor.name, organisation.name as "Alignment", power.description, power.powerLevel
from game inner join world on game.id = world.gameId
	inner join continent on continent.worldId = world.id
    inner join continentnation on continentnation.continentId = continent.id
    inner join nation on continentnation.nationId = nation.id
    inner join city on city.nationId = nation.id
    inner join cityorganisation on cityorganisation.cityId = city.id
    inner join organisation on cityorganisation.organisationId = organisation.id
    inner join powerpyramid on organisation.id = powerpyramid.organisationId
    inner join actor on powerpyramid.actorId = actor.id
    inner join power on powerpyramid.powerId = power.id

/*select actor name and attributes and actor information*/
select actor.name, charinfovm.name, attributevm.name, statblockvmattribute.dots
from actor INNER JOIN stats on actor.id = stats.actorId
	INNER JOIN statblockvm on stats.statBlockVMId = statblockvm.id
    INNER JOIN charinfovm on statblockvm.charInfoVMId = charinfovm.id
    INNER JOIN statblockvmattribute on statblockvmattribute.statBlockVMId = statblockvm.id
    INNER JOIN attributevm on statblockvmattribute.attributeVMId = attributevm.id  

/*select actor name and discipline&discipline group*/
select actor.name,  disciplinegroupvm.name, disciplinevm.name
from actor INNER JOIN stats on actor.id = stats.actorId
	INNER JOIN statblockvm on stats.statBlockVMId = statblockvm.id
    INNER JOIN charinfovm on statblockvm.charInfoVMId = charinfovm.id
    INNER JOIN statblockvmdiscipline on statblockvmdiscipline.statBlockVMId = statblockvm.id
    INNER JOIN disciplinevm on statblockvmdiscipline.disciplineVMId = disciplinevm.id
    INNER JOIN disciplinegroupvm on statblockvmdiscipline.disciplineGroupVMId = disciplinegroupvm.id