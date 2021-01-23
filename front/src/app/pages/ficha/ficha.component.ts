import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

import { PlantasService } from "src/app/services/plantas.service";

@Component({
  selector: 'app-ficha',
  templateUrl: './ficha.component.html',
  styleUrls: ['./ficha.component.scss']
})
export class FichaComponent implements OnInit {

  ficha_pk:number;
  ficha:any;
  
  constructor(
    private route: ActivatedRoute,
    private router: Router,
    private plantasSrv:PlantasService,
    ) { }

  ngOnInit(): void {
    this.ficha_pk = this.route.snapshot.queryParams['pk'];
    if (this.ficha_pk) {
      this.plantasSrv.get_ficha(this.ficha_pk).subscribe(
        res => this.ficha = res,
        err => {
          if (err.status === 404) {
            this.navigate2('404');
          }
        }
      )
    }else{
      this.navigate2('404');
    }
  }

  navigate2(url:string) {
    this.router.navigate([url]);
  }

  warp(value) {
    return value ? value : '?'
  }

}
