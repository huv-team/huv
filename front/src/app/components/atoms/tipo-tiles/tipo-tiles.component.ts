import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-tipo-tiles',
  templateUrl: './tipo-tiles.component.html',
  styleUrls: ['./tipo-tiles.component.scss']
})
export class TipoTilesComponent implements OnInit {

  @Input() tipo:string;

  types:any = { fruto: 'FR', flor: 'FL', hola: 'HO', raiz: 'RA' };

  constructor() { }

  ngOnInit(): void {
  }

}
