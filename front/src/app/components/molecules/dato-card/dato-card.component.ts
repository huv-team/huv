import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-dato-card',
  templateUrl: './dato-card.component.html',
  styleUrls: ['./dato-card.component.scss']
})
export class DatoCardComponent implements OnInit {

  @Input() tipo:string;
  @Input() title:string;
  @Input() subtitle:string;
  @Input() value;
  
  constructor() { }

  ngOnInit(): void {
  }

}
