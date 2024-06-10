const cities = require('./zipCodeModule_v1');
const colors = require('colors');
const log = console.log

log(colors.red('Loopup by zip code (02215)'))
log(cities.lookupByZipCode('02215'))


log(colors.red('Loopup by zip code (99999)'))
log(cities.lookupByZipCode('99999'))

log(colors.red('Loopup by city (BOSTON, MA)'))
log(cities.lookupByCityState('BOSTON', 'MA'))

log(colors.red('Loopup by city (BOSTON, TX)'))
log(cities.lookupByCityState('BOSTON','TX'))

log(colors.red('Loopup by city (BOSTON, AK)'))
log(cities.lookupByCityState('BOSTON','AK'))

log(colors.red('Get population by state (MA)'))
log(cities.getPopulationByState('MA'))

log(colors.red('Get population by state (TX)'))
log(cities.getPopulationByState('TX'))

log(colors.red('Get population by state (AA)'))
log(cities.getPopulationByState('AA'))
