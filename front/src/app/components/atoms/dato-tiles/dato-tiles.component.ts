import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-dato-tiles',
  templateUrl: './dato-tiles.component.html',
  styleUrls: ['./dato-tiles.component.scss']
})
export class DatoTilesComponent implements OnInit {

  @Input() tipo:string;
  
  constructor() { }

  ngOnInit(): void {
  }

}
