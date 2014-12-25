include_recipe 'apt'
include_recipe 'php'
include_recipe 'percona::server'


package 'curl'
package 'php5-curl'
package "php5-intl"
package "php5-dev"
package 'redis-server'

service "mysql" do
 supports :status => true, :start => true, :stop => true, :restart => true
 action [ :enable, :start ]
end

include_recipe 'database::default'
include_recipe 'mysql::server'
include_recipe 'mysql::client'