import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-planta-card',
  templateUrl: './planta-card.component.html',
  styleUrls: ['./planta-card.component.scss']
})
export class PlantaCardComponent implements OnInit {

  @Input() data;
  
  constructor() { }

  ngOnInit(): void {
  }

}
