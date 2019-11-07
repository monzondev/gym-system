# psql -U $POSTGRES_USER -d $POSTGRES_DB -f /root/script.sql
# psql -U $POSTGRES_USER -d $POSTGRES_DB -f /root/data-script.sql
psql -U $POSTGRES_USER -d $POSTGRES_DB -f /root/clean-script.sql