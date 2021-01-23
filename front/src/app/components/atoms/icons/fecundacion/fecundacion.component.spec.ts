import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { FecundacionComponent } from './fecundacion.component';

describe('FecundacionComponent', () => {
  let component: FecundacionComponent;
  let fixture: ComponentFixture<FecundacionComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ FecundacionComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(FecundacionComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
