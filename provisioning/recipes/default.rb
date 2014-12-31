include_recipe 'apt'
include_recipe 'php'

package 'curl'
package 'php5-curl'
package 'php5-intl'
package 'php5-dev'
package 'redis-server'
package 'libssl-dev'

include_recipe 'database::mysql'