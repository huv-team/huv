import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { FlorComponent } from './flor.component';

describe('FlorComponent', () => {
  let component: FlorComponent;
  let fixture: ComponentFixture<FlorComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ FlorComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(FlorComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
