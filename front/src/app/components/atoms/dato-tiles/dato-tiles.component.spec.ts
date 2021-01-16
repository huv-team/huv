import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DatoTilesComponent } from './dato-tiles.component';

describe('DatoTilesComponent', () => {
  let component: DatoTilesComponent;
  let fixture: ComponentFixture<DatoTilesComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DatoTilesComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DatoTilesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
