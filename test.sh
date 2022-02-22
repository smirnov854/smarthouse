#!/bin/bash
month=$(date +'%Y-%m')
firstday='2022-01-01 00:00:00' #$(date +'%Y-%m-01 00:00:00')
lastday='2022-02-10 00:00:00' #$(date +'%Y-%m-31 23:59:59')
reportname=$(echo $month'.csv')
rm -f flat-id_meter-id.csv flat-id_meter-id.csv month_report.csv $reportname
touch flat-id_meter-id.csv flat-id_meter-id.csv month_report.csv $reportname
psql -d smarthouse -t -q -c "SELECT id, name FROM public.flat order by id;" | sed 's/\ //g' | sed 's/|/;/g' > flats.csv
echo "Get flats and meters..."
cat flats.csv | while read line ; do
  IFS=";"
  set -- $line
  flat_id=$1
  flat_name=$2
  if [ -n "$flat_id" ]
  then
    psql -d smarthouse -t -q -c "select flat_id,id,acc_id from public.flat_meter where flat_id = $flat_id and name <> 'дат.про';" | sed 's/\ //g' >> flat-id_meter-id.csv
  fi
done
echo "Get month values..."
cat flat-id_meter-id.csv | while read line ; do
  IFS="|"
  set -- $line
  flat_id=$1
  meter_id=$2
  acc_id=$3
  if [ -n "$meter_id" ]
  then
    meter_value=$(psql -d smarthouse -t -q -c "SELECT sum(value) FROM public.meter_data where meter_id = $meter_id and stamp >= '$firstday' and stamp < '$lastday';" | sed 's/\ //g')
    deveui=$(psql -d smarthouse -t -q -c "select deveui from acc where id=$acc_id;")
    if [ -n "$meter_value" ]
    then
      echo $flat_id';'$meter_id';'$meter_value';'$deveui >> month_report.csv
    else
      echo $flat_id';'$meter_id';0.000;'$deveui >> month_report.csv
    fi
  fi
done
echo "Generate report..."
cat month_report.csv | while read line ; do
  IFS=";"
  set -- $line
  flat_id=$1
  meter_id=$2
  value=$3
  deveui=$4
  flat_name=$(psql -d smarthouse -t -q -c "SELECT name FROM public.flat where id = $flat_id;")
  meter_name=$(psql -d smarthouse -t -q -c "SELECT name FROM public.flat_meter where id = $meter_id;")
  echo $flat_name';'$meter_name';'$value';'$deveui >> $reportname
done
echo "Report has been generated!"
exit 0