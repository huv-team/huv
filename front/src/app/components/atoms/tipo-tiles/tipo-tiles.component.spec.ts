import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TipoTilesComponent } from './tipo-tiles.component';

describe('TipoTilesComponent', () => {
  let component: TipoTilesComponent;
  let fixture: ComponentFixture<TipoTilesComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TipoTilesComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TipoTilesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
