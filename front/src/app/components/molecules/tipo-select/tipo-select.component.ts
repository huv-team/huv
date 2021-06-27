import { Component, OnInit, Input } from '@angular/core';
import { PlantasService } from 'src/app/services/plantas.service';

@Component({
  selector: 'app-tipo-select',
  templateUrl: './tipo-select.component.html',
  styleUrls: ['./tipo-select.component.scss']
})
export class TipoSelectComponent implements OnInit {

  @Input() multi:boolean = false;
  @Input() label:string = 'Selecciona un tipo:';

  selected:Set<string> = new Set<string>(['FR']);

  types:any[] = [];
  loading:boolean;
  
  constructor(
    private plantasSrv:PlantasService,
  ) { }
  
  ngOnInit(): void {
    this.loading = true;
    this.plantasSrv.get_tipos_list().subscribe(
      res => {
        this.types = res.types;
      },
      err => {
        console.log(err);
      },
      () => {
        this.loading = false;
      }
    )
  }

  get selection(){
    return Array.from(this.selected);
  }

  isSelected(key:string):boolean {
    return this.selected.has(key);
  }

  changeSelected(key:string) {
    if (this.multi){
      if (this.isSelected(key)){
        this.selected.delete(key);
      }else{
        this.selected.add(key);
      }
    }else{
      this.selected.clear();
      this.selected.add(key);
    }
  }

}
