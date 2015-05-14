# biblio
software para el proyecto de grado 
unidades tecnologicas de santander

@elkinlrc


la tabla metadatos campos nuevos

 minimo numeric(4,0) DEFAULT 0,
  maximo numeric(4,0) DEFAULT 0,
  requerido character(2),
  CONSTRAINT pk_metadatos PRIMARY KEY (codmetadato),
  CONSTRAINT metadatos_requerido_check CHECK (requerido = 'si'::bpchar OR requerido = 'no'::bpchar)
)