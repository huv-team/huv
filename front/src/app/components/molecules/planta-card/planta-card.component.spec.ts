import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PlantaCardComponent } from './planta-card.component';

describe('PlantaCardComponent', () => {
  let component: PlantaCardComponent;
  let fixture: ComponentFixture<PlantaCardComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PlantaCardComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PlantaCardComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
