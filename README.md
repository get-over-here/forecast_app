# Start locally

`./vendor/bin/sail up`

# Reset migrations

`./vendor/bin/sail artisan migrate:reset`

# Migrations

`./vendor/bin/sail artisan migrate`


# Seed forecasts table with test data

`./vendor/bin/sail artisan db:seed`


# Tests

`./vendor/bin/sail artisan test`
`./vendor/bin/sail artisan schedule:test --name="App\Jobs\ForecastQueryJob"`

# Other

## Add location
`curl --header "Accept: application/json" --header "Content-Type: application/json" --request POST --data '{"name":"London","latitude":51.509865,"longitude":-0.118092}' http://localhost:8084/api/v1/append`

## Test request
`curl --verbose --header "Accept: application/json" --header "Content-Type: application/json" "http://localhost:8084/api/v1/show?location=London&startDate=946695600&endDate=946749600"`


# Tools

## Portainer

`docker volume create portainer_data`

`docker run -d -p 8000:8000 -p 9443:9443 -p 9000:9000 --name portainer --restart=always -v /var/run/docker.sock:/var/run/docker.sock -v portainer_data:/data portainer/portainer-ce:latest`

## Adminer

`docker run -p 8080:8080 -e ADMINER_DEFAULT_SERVER=mysql ghcr.io/shyim/adminerevo:latest`
