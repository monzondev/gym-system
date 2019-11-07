do
$$
declare
  l_stmt text;
begin
  select 'truncate ' || string_agg(format('%I.%I', schemaname, tablename), ',')
    into l_stmt
  from pg_tables
  where schemaname in ('public');
  ALTER SEQUENCE miembro_id_miembro_seq RESTART WITH 1;
  ALTER SEQUENCE empleado_id_empleado_seq RESTART WITH 1;
  ALTER SEQUENCE tipo_membresia_id_tipo_membresia_seq RESTART WITH 1;
  ALTER SEQUENCE pago_id_pago_seq RESTART WITH 1;
  ALTER SEQUENCE tipo_empleado_id_tipo_empleado_seq RESTART WITH 1;
  ALTER SEQUENCE estado_id_estado_seq RESTART WITH 1;
  execute l_stmt;
end;
$$



