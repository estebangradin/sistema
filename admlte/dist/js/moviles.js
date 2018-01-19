function cambiar(valor){
	switch(valor)
	{
	case 'Fiat': 
		 $("#modelo").find('option').remove().end().append('<option value="-1">Seleccione un modelo</option>').val('-1');
		 $("#modelo").append(new Option("Uno Fire", "Uno Fire"));
		 $("#modelo").append(new Option("Uno Evo",  "Uno Evo"));
		 $("#modelo").append(new Option("Palio",    "Palio"));
		 $("#modelo").append(new Option("Siena",    "Siena"));
		 $("#modelo").append(new Option("Bravo",    "Bravo"));
		 $("#modelo").append(new Option("Weekend",  "Weekend"));
		 $("#modelo").append(new Option("Stilo",    "Stilo"));
		 $("#modelo").append(new Option("Marea",    "Marea"));
		 $("#modelo").append(new Option("Punto",    "Punto"));
		 $("#modelo").append(new Option("Qubo",     "Qubo"));
		 $("#modelo").append(new Option("Linea",   "Linea"));
		 $("#modelo").append(new Option("Idea",    "Idea"));
		 $("#modelo").append(new Option("Dobló",   "Dobló"));
		 $("#modelo").append(new Option("Fiorino", "Fiorino"));
	break;	
	case 'VW': 
		 $("#modelo").find('option').remove().end().append('<option value="-1">Seleccione un modelo</option>').val('-1');
		 $("#modelo").append(new Option("Gol",    "Gol"));
		 $("#modelo").append(new Option("Fox",    "Fox"));
		 $("#modelo").append(new Option("Bora",   "Bora"));
		 $("#modelo").append(new Option("Suran",  "Suran"));
		 $("#modelo").append(new Option("Voyage", "Voyage"));
		 $("#modelo").append(new Option("Golf",   "Golf"));

	break;		
	case 'Ford': 
		 $("#modelo").find('option').remove().end().append('<option value="-1">Seleccione un modelo</option>').val('-1');
		 $("#modelo").append(new Option("Ka",   	 "Ka"));
		 $("#modelo").append(new Option("Mondeo",    "Mondeo"));
		 $("#modelo").append(new Option("Cruiser",   "Cruiser"));
		 $("#modelo").append(new Option("Focus",     "Focus"));
		 $("#modelo").append(new Option("Fiesta",    "Fiesta"));
		 $("#modelo").append(new Option("Ecosport",  "Ecosport"));
	break;	
	case 'Peugeot': 
		 $("#modelo").find('option').remove().end().append('<option value="-1">Seleccione un modelo</option>').val('-1');
		 $("#modelo").append(new Option("206",   	 "206"));
		 $("#modelo").append(new Option("207",       "207"));
		 $("#modelo").append(new Option("307",       "307"));
		 $("#modelo").append(new Option("408",       "408"));
		 $("#modelo").append(new Option("Partner",   "Partner"));
	break;
	case 'Toyota': 
		 $("#modelo").find('option').remove().end().append('<option value="-1">Seleccione un modelo</option>').val('-1');
		 $("#modelo").append(new Option("Etios",   	 "Etios"));
		 $("#modelo").append(new Option("Carmy",     "Carmy"));
		 $("#modelo").append(new Option("Corolla",   "Corolla"));
	break;	
	case 'Renault': 
		 $("#modelo").find('option').remove().end().append('<option value="-1">Seleccione un modelo</option>').val('-1');
		 $("#modelo").append(new Option("Clio",       "Clio"));
		 $("#modelo").append(new Option("Megane",     "Megane"));
		 $("#modelo").append(new Option("Fluence",    "Fluence"));
		 $("#modelo").append(new Option("Sandero",    "Sandero"));
		 $("#modelo").append(new Option("Logan",      "Logan"));
		 $("#modelo").append(new Option("StepWay",    "StepWay"));
		 $("#modelo").append(new Option("Duster",     "Duster"));
		 $("#modelo").append(new Option("Kangoo",     "Kangoo"));
		 $("#modelo").append(new Option("Symbol",     "Symbol"));
		 $("#modelo").append(new Option("Scenic",     "Scenic"));
	break;	
	case 'Chevrolet': 
		 $("#modelo").find('option').remove().end().append('<option value="-1">Seleccione un modelo</option>').val('-1');
		 $("#modelo").append(new Option("Agile",      "Agile"));
		 $("#modelo").append(new Option("Astra",      "Astra"));
		 $("#modelo").append(new Option("Aveo",       "Aveo"));
		 $("#modelo").append(new Option("Celta",      "Celta"));
		 $("#modelo").append(new Option("Classic",    "Classic"));
		 $("#modelo").append(new Option("Corsa",      "Corsa"));
		 $("#modelo").append(new Option("Meriva",     "Meriva"));
		 $("#modelo").append(new Option("Onix",       "Onix"));
		 $("#modelo").append(new Option("Prisma",     "Prisma"));
		 $("#modelo").append(new Option("Vectra",     "Vectra"));
		 $("#modelo").append(new Option("Sonic",      "Sonic"));
		 $("#modelo").append(new Option("Spin",       "Spin"));
		 $("#modelo").append(new Option("Safira",     "Safira"));
	break;		
	case 'Citroën': 
		 $("#modelo").find('option').remove().end().append('<option value="-1">Seleccione un modelo</option>').val('-1');
		 $("#modelo").append(new Option("C3",   	 "C3"));
		 $("#modelo").append(new Option("C4",        "C4"));
		 $("#modelo").append(new Option("Berlingo",  "Berlingo"));
		 $("#modelo").append(new Option("Picasso",   "Picasso"));
		 $("#modelo").append(new Option("Xsara",     "Xsara"));
	break;	
	}
}