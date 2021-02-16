import { Component, OnInit } from '@angular/core';
import { PlantasService } from 'src/app/services/plantas.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-fuentes',
  templateUrl: './fuentes.component.html',
  styleUrls: ['./fuentes.component.scss']
})
export class FuentesComponent implements OnInit {

  fuentes:any;
  
  constructor(
    private plantasSrv: PlantasService,
    private router: Router,
    ) { }

  ngOnInit(): void {
    this.plantasSrv.get_fuentes_list().subscribe(
      res => this.fuentes = res,
      err => {
        if (err.status === 404) {
          this.navigate2('404');
        }
      }
    )
  }

  navigate2(url:string) {
    this.router.navigate([url]);
  }

}
