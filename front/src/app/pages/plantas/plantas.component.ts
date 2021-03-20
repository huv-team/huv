import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl } from "@angular/forms";

import { Store } from '@ngxs/store';
import { PlantasStateModel } from "src/app/redux/plantas/plantas.model";
import { GetPlantas } from "src/app/redux/plantas/plantas.actions";

import { PlantasService } from "src/app/services/plantas.service";
import { Router } from '@angular/router';
import { Observable } from 'rxjs';

@Component({
  selector: 'app-plantas',
  templateUrl: './plantas.component.html',
  styleUrls: ['./plantas.component.scss']
})
export class PlantasComponent implements OnInit {

  plantas$: Observable<PlantasStateModel>;
  plantasList:any;
  plantasQueryForm:FormGroup;
  
  constructor(
    private store:Store,
    private plantasSrv:PlantasService,
    private router:Router,
  ) {
    this.plantas$ = this.store.select( state => state.plantas );
  }

  ngOnInit(): void {
    this.store.dispatch(new GetPlantas());
    this.plantas$.subscribe(
      data => {
        console.log(data.list.length)
        this.plantasList = data.list;
      }
    );

    this.plantasQueryForm = new FormGroup({
      nombre: new FormControl(''),
    })

  }

  buscar() {
    const query = 'nombre=' + this.plantasQueryForm.value.nombre
    this.plantasSrv.get_plantas_list(query).subscribe(
      res => {
        this.plantasList = res;
      },
      err => {
        console.log(err);
      }
    );
  }

  navigate2ficha(pk:number) {
    this.router.navigate(['ficha'], { queryParams: { pk:pk } });
  }

}
