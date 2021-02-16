import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-fuente-card',
  templateUrl: './fuente-card.component.html',
  styleUrls: ['./fuente-card.component.scss']
})
export class FuenteCardComponent implements OnInit {

  @Input() fuente:any;
  
  constructor() { }

  ngOnInit(): void {
  }

}
